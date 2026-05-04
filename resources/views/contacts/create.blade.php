<h1>Добавить клиента</h1>

<form method="POST" action="/contacts">
    @csrf
    <input type="text" name="name" placeholder="Имя"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="text" name="phone" placeholder="Телефон"><br>
    <button type="submit">Сохранить</button>
</form>