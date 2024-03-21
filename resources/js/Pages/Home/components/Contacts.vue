<template>
    <div class="contact_container pt-10">
        <div class="container ">
            <div class="contact_details row">
                <div class="details col">
                    <h4>We'd Love to Talk about How We Can <span class="plan">Plan</span> <span
                            class="together">Together</span></h4>
                    <p>If you have any inquiries please don't hesitate to get in touch</p>

                    <div class="social_media d-flex align-items-center">
                        <p>Follow us on social media: </p>
                        <div class="d-flex">
                            <a class="ml-2 mr-2" href="#"><i class='bx bxl-facebook-circle'></i></a>
                            <a class="ml-2 mr-2" href="#"><i class='bx bxl-facebook-circle'></i></a>
                            <a class="ml-2 mr-2" href="#"><i class='bx bxl-facebook-circle'></i></a>
                            <a class="ml-2 mr-2" href="#"><i class='bx bxl-facebook-circle'></i></a>
                            <a class="ml-2 mr-2" href="#"><i class='bx bxl-facebook-circle'></i></a>

                        </div>
                    </div>
                </div>
                <div class="contact_illust col">
                    <img src="images/contact.png" alt="">
                </div>
            </div>

            <div class="contact_form row">
                <form id="contactForm" class="container">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>
                        <div class="mb-3 col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="helpOption" class="form-label">How can we help you?</label>
                        <select class="form-select" id="helpOption" name="helpOption" required>
                            <option value="">Select an option</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Billing Issue">Billing Issue</option>
                            <option value="Feedback">Feedback</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn submit_btn">Submit</button>
                </form>
            </div>
        </div>

    </div>
</template>

<style>
.submit_btn {
    background: var(--main-blue);
    color: var(--main-white) !important;
    border: 1px solid var(--main-blue) !important;
}

.contact_container {
    width: 100%;
    height: auto;
    background: var(--main-green);
    margin-bottom: 20px;
    padding: 20px;
}

.details {
    &>h4 {
        color: var(--main-white);
        font-size: 2.5rem;
        margin-top: 1rem;
        font-weight: bold;

        &>.plan {
            color: var(--main-orange);
        }

        &>.together {
            color: var(--main-blue);
        }
    }

    &>p {
        color: var(--main-blue);
        margin-top: 1rem;
        font-weight: 500;
    }

    &>.social_media {
        margin-top: 3rem;
        color: var(--main-blue);
        gap: 1rem;

        &>.d-flex {
            background: var(--main-orange);
            border-radius: 20px;

            &>a {
                font-size: 1.5rem;
                color: var(--main-blue);
                margin-top: 5px;
            }
        }

    }
}


img {
    width: 300px;
}

.contact_form {
    margin-top: 3rem;
    background: rgb(255, 255, 255, 0.3);
    backdrop-filter: blur(20px);
    border-radius: 1rem;
    padding: 1rem;
    box-shadow: 0 8px 32px 0 var(--main-blue);
}
</style>