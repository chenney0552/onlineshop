    <footer>
        <ul class="business-list">
            <li><a href="">COUNTRY/REGION: CANADA</a></li>
            <li><a href="">NEWSLETTER SIGNUP</a></li>
            <li><a href="">CUSTOMER CARE</a></li>
            <li><a href="">ABOUT US</a></li>
        </ul>
        <ul class="social-list">
            <li><a href="https://www.youtube.com" target="_blank"><i class="uil uil-youtube"></i></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><i class="uil uil-instagram-alt"></i></a></li>
            <li><a href="https://www.facebook.com" target="_blank"><i class="uil uil-facebook"></i></a></li>
            <li><a href="https://www.twitter.com/" target="_blank"><i class="uil uil-twitter"></i></a></li>
        </ul>
    </footer>
</body>
<script>
    document.getElementById("logout").addEventListener("click", ()=> sessionStorage.clear());
    let basket = JSON.parse(localStorage.getItem("basket")) || [];
    document.getElementById("shoppingbag").innerHTML = `Shopping Bag${basket.length===0? "":"("+basket.length+")"}`;
</script>
</html>