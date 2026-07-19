<h2>Đăng ký tư vấn</h2>


<form method="post"
action="/public-leads">


<input type="text"
name="name"
placeholder="Tên"
value="<?=htmlspecialchars($old['name'])?>">


<br>


<input type="email"
name="email"
placeholder="Email"
value="<?=htmlspecialchars($old['email'])?>">


<br>


<input type="text"
name="phone"
placeholder="SĐT">


<br>


<textarea name="message"></textarea>


<!-- honeypot -->
<input 
type="text"
name="website"
style="display:none">


<button>
Gửi
</button>


</form>