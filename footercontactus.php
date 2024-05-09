<!-- contactus -->

<section id="contactus">
    <div class="contact-content">
        <div class="contact-info">
            <div><i class="fa-solid fa-location-dot"></i> Quezon City, Philippines</div>
            <div><i class="fa-solid fa-envelope"></i>renzandco@gmail.com</div>
            <div><i class="fa-solid fa-mobile"></i>0905-964-0381</div>
        </div>
        <div class="contact-form">
            <h2>Contact Us</h2>
            <form class="contact" action="smtpScript.php" method="post" enctype="multipart/form-data">

                <input type="text" name="name" class="text-box" placeholder="Your Name" required>
                <input type="email" name="email" class="text-box" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder=""></textarea>
                <button class="btn btn-dark" type="submit" name="send">SEND</button>

            </form>
        </div>
    </div>
</section>