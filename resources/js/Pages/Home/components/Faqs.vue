<script>
export default {
    mounted() {
        const faqaItems = document.querySelectorAll('.faqs_item');

        faqaItems.forEach(element => {
            element.addEventListener("click", () => {
                const iconItem = element.querySelector('.bx');
                const answer = element.querySelector('.faqs_answer');

                answer.classList.toggle("open");

                faqaItems.forEach(item => {
                    if (item !== element) {
                        const otherIcon = item.querySelector('.bx');
                        let searchItem = item.querySelector('.faqs_answer')
                        otherIcon.classList.remove('bx-chevron-up');
                        otherIcon.classList.add('bx-chevron-down');

                        if (searchItem.classList.contains("open")) {
                            searchItem.classList.remove("open")

                        }
                    }
                });

                if (iconItem.classList.contains('bx-chevron-up')) {
                    iconItem.classList.remove('bx-chevron-up');
                    iconItem.classList.add('bx-chevron-down');
                } else {
                    iconItem.classList.remove('bx-chevron-down');
                    iconItem.classList.add('bx-chevron-up');
                }
            });
        });

    }
}
</script>

<template>
    <div class="faq_container mt-10 p-3">
        <div class="fs-2 text-center">
            Frequently Asked Questions (FAQs)
        </div>
        <div class="faq_holder mt-10 container">
            <div class="faqs_item card mt-1">
                <div class="faq_question">
                    How do I create an event on your platform?
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="faqs_answer ">
                    To create an event, simply sign up for an account, then navigate to the "Create Event" page and fill
                    out the required details such as event name, date, time, location, and description. Once submitted,
                    your event will be live on our platform.
                </div>
            </div>

            <div class="faqs_item card mt-1">
                <div class="faq_question">
                    Can I edit or update my event details after it's been posted?
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="faqs_answer">
                    Yes, you can edit or update your event details at any time by logging into your account and
                    accessing
                    the "Manage Events" section. From there, you can make changes to your event information, including
                    date,
                    time, location, and description.
                </div>
            </div>

            <div class="faqs_item card mt-1">
                <div class="faq_question">
                    How do attendees register for my event?
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="faqs_answer">
                    Attendees can register for your event by visiting the event page on our platform and clicking the
                    "Register" or "RSVP" button. They will then be prompted to fill out a registration form with their
                    details, and upon submission, they will receive a confirmation email.
                </div>
            </div>

            <div class="faqs_item card mt-1">
                <div class="faq_question">
                    What payment options do you accept for event registrations?
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="faqs_answer">
                    We accept various payment options including credit/debit cards, PayPal, and bank transfers. Event
                    organizers can choose their preferred payment methods and set up ticket prices and discounts
                    accordingly.
                </div>
            </div>

            <div class="faqs_item card mt-1">
                <div class="faq_question">
                    Is there a fee for using your event management platform?
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="faqs_answer">
                    Our event management platform offers both free and paid plans. The free plan includes basic features
                    such as event creation and registration, while the paid plans offer additional benefits such as
                    advanced
                    analytics, customization options, and priority support.
                </div>
            </div>

            <div class="faqs_item card mt-1">
                <div class="faq_question">
                    How can I contact your support team for assistance?
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="faqs_answer">
                    You can contact our support team by emailing support@eventpulse.com or filling out the contact form on
                    our website. Our team is available to assist you with any questions, technical issues, or feedback
                    you
                    may have regarding our platform.
                </div>
            </div>
        </div>

    </div>
</template>

<style>
.faq_container {
    height: auto;

    & .fs-2 {
        background: linear-gradient(217deg, var(--main-orange) 50%, var(--main-blue) 50%);
        color: var(--main-white);
    }
}

.faq_holder {
    height: auto;
}

.faqs_item {
    max-width: 100% !important;
    margin: 0 !important;
    padding: 1rem;
    transition: all ease 2s;
}

.faq_question {
    font-size: 2rem;
    font-weight: bold;
    display: flex;
    justify-content: space-between;

    & .bx {
        background: var(--main-orange);
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        border-radius: 50%;
    }
}

.faqs_answer {
    display: none;
    transition: all ease 2s;
}

.open {
    display: block;
    transition: all ease 2s;
}
</style>