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
                <form action="">

                </form>
            </div>
        </div>

    </div>
</template>

<style>
.contact_container {
    width: 100%;
    height: 90vh;
    background: var(--main-green);

    &>.container {
        border: 1px solid;
    }
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
</style>