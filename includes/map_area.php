<section class="  black_bg text_white" id="contact">


<div class="  fadeInRight container ">
    <article class="contact" data-page="contact">
    <div class=" fadeInRight section_title text-center mb-60 mt-6">
        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s" >CONTACT US</h3>
    </div>
        <section class="  mapbox text-center" data-mapbox>
            <figure >
                <iframe
                    src="https://maps.google.com/maps?width=684&amp;height=615&amp;hl=en&amp;q=mea engin&amp;t=k&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                    width="100%" height="300" loading="lazy" style="border:0;" allowfullscreen></iframe>
            </figure>
        </section>

        <section class="contact-form mt-4">
        <div class=" fadeInRight  ">
            <h3 class="  text-white wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s" >Get in Touch</h3>
        </div>
            <form action="contact.php" method="POST" class="form" data-form>
                <div class="form-row">
                    <div class=" form-group col-md-6">
                        <input type="text" name="fullname" class="form-control" placeholder="Full Name" required data-form-input>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required data-form-input>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required data-form-input></textarea>
                </div>

                <button class="btn boxed-btn2  btn-block" type="submit" data-form-btn>
                    <ion-icon name="paper-plane"></ion-icon>
                    <span>Send Message</span>
                </button>
            </form>
        </section>
    </article>
</div>
</section>
