import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {

    let dragged = null;

    // --- START DRAG
    document.querySelectorAll('[draggable="true"]').forEach(el => {

        el.addEventListener('dragstart', () => {
            dragged = el;

            el.classList.add(
                'opacity-50',
                'scale-105',
                'shadow-xl'
            );
        });

        el.addEventListener('dragend', () => {
            dragged = null;

            el.classList.remove(
                'opacity-50',
                'scale-105',
                'shadow-xl'
            );
        });

    });

    // --- ПОДСВЕТКА КОЛОНОК (через document)
    document.addEventListener('dragover', (e) => {
        e.preventDefault();

        const column = e.target.closest('[data-status]');
        if (!column) return;

        // убираем подсветку у всех
        document.querySelectorAll('[data-status]').forEach(col => {
            col.classList.remove('bg-blue-50', 'border-blue-300');
        });

        // подсвечиваем текущую
        column.classList.add('bg-blue-50', 'border-blue-300');
    });

    // --- DROP
    document.querySelectorAll('[data-status]').forEach(column => {

        column.addEventListener('drop', (e) => {
            e.preventDefault();

            // убираем подсветку
            document.querySelectorAll('[data-status]').forEach(col => {
                col.classList.remove('bg-blue-50', 'border-blue-300');
            });

            if (!dragged) return;

            const draggedEl = dragged;
            const dealId = draggedEl.dataset.id;
            const newStatus = column.dataset.status;
            const oldColumn = draggedEl.closest('[data-status]');

            fetch(`/deals/${dealId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(() => {

                const newList = column.querySelector('.space-y-3');
                const oldList = oldColumn.querySelector('.space-y-3');
                const oldStatus = oldColumn.dataset.status;

                // переносим карточку
                newList.appendChild(draggedEl);

                // обновляем select
                const select = draggedEl.querySelector('select');
                if (select) select.value = newStatus;

                // убираем "Нет сделок" в новой колонке
                const emptyNew = column.querySelector('.empty-text');
                if (emptyNew) emptyNew.remove();

                // если старая колонка пустая → добавить текст
                if (oldList.children.length === 0) {
                    const emptyDiv = document.createElement('div');
                    emptyDiv.className = 'empty-text text-sm text-gray-400 text-center py-4';
                    emptyDiv.innerText = 'Нет сделок';
                    oldList.appendChild(emptyDiv);
                }

                // --- toast с undo
                showUndoToast('Сделка обновлена', () => {

                    fetch(`/deals/${dealId}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            status: oldStatus
                        })
                    })
                    .then(() => {

                        const originalList = oldColumn.querySelector('.space-y-3');

                        originalList.appendChild(draggedEl);

                        if (select) select.value = oldStatus;

                    });

                });

            });

        });

    });

});

function showUndoToast(message, onUndo) {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');
    toast.className = `
        bg-green-600 text-white px-5 py-3 rounded-full shadow-lg
        flex flex-col gap-2
        opacity-0 translate-y-4 transition duration-300
        min-w-[250px]
    `;

    toast.innerHTML = `
        <div class="flex items-center justify-between gap-4">
            <span>${message}</span>
            <button class="underline text-white/80 hover:text-white">Отменить</button>
        </div>

        <div class="w-full h-1 bg-white/30 rounded overflow-hidden">
            <div class="progress-bar h-full bg-white"></div>
        </div>
    `;

    const undoBtn = toast.querySelector('button');
    const progressBar = toast.querySelector('.progress-bar');

    container.appendChild(toast);

    // анимация появления
    setTimeout(() => {
        toast.classList.remove('opacity-0', 'translate-y-4');
    }, 10);

    // --- таймер
    let duration = 3000;
    let start = Date.now();

    const interval = setInterval(() => {
        let elapsed = Date.now() - start;
        let percent = Math.max(0, 1 - elapsed / duration);

        progressBar.style.width = percent * 100 + '%';

        if (percent <= 0) {
            clearInterval(interval);
        }
    }, 16);

    // --- undo
    undoBtn.addEventListener('click', () => {
        clearInterval(interval);
        onUndo();
        toast.remove();
    });

    // --- авто удаление
    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-4');

        setTimeout(() => {
            toast.remove();
        }, 300);
    }, duration);
}