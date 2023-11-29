<template>
    <div id="app" class="email-code-container login-section">
        <div class="emailcode-holder">
            <span class="instruction-text">Enter the code sent to your email. It expires in 24 hours.</span>
            <form @submit.prevent="">
                <div class="code-input-container">
                    <input class="form-control mb-3 code-input" type="text" placeholder="Verification Code" />
                </div>
                <button type="submit" class="email-code-submit">Submit</button>
            </form>
        </div>
    </div>
</template>

<style>
@import url("./styles/login.css");

.email-code-container {
    display: grid;
    place-items: center;
    text-align: center;
    max-width: 1500px;
    height: 100vh;
}

.emailcode-holder {
    max-width: 600px;
    height: 50%;
    /* background-color: gray; */
    border: 1px solid var(--main-green);
    padding: 1rem;
    
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 128, 0, 0.5);
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 128, 0, 0.1);
}


.code-input-container {
    display: flex;
    justify-content: center;
}

.code-input {
    width: 100%;
    text-align: center;
    font-size: 1.5rem;
    color: var(--main-blue);
    margin-top: 10%;
}

.instruction-text {
    color: var(--main-blue);
    font-weight: bold;
    font-size: 1.5rem;
}

.email-code-submit {
    background: var(--main-blue);
    color: var(--main-white) !important;
    width: 100%;
    font-size: 1.3em;
    padding: 0.5em;
    border-radius: 0.3em;
    margin-top: 5%;
    border: none;
    cursor: pointer;
    outline: none;

}
</style>
