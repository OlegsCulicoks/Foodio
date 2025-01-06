
const bar = document.querySelector('.fa-bars');
const cross = document.querySelector('#hdcross');
const headerbar = document.querySelector('.headerbar');
const crosssignmb = document.querySelector('#x-sign-mb');
const sign = document.querySelector('.sign');
const signbox = document.querySelector('.sign-box');
const tosignin = document.querySelector('#to-signin');
const tosignup = document.querySelector('#to-signup');
const signup = document.querySelector('.signup');
const signin = document.querySelector('.signin');
const signlogo = document.querySelector('#user-lap');
const signlogomb = document.querySelector('#user-mb');



// when bar icon (tablet/mobile) clicked it will display the hidden header bar.
bar.addEventListener('click', () => {
    setTimeout(() => {
        cross.style.display = 'block';
    }, 200);
    headerbar.style.right = '0%';
})

// when cross icon (tablet/mobile) clicked it will hide the showing header bar.
cross.addEventListener('click', () => {
    cross.style.display = 'none';
    headerbar.style.right = '-100%';
})

//when click on Id=x-sign it will hide the sign up form
function removeSignform() {
    signbox.style.transform = 'scale(0)';
    setTimeout(() => {
        sign.style.display = 'none';
    }, 400);
}
crosssignmb.addEventListener('click', removeSignform)

// when click on user icon in header it will show the sign up form
signlogo.addEventListener('click', () => {
    sign.style.display = 'flex';
    setTimeout(() => {
        signbox.style.transform = 'scale(1)';
    }, 100);
})
signlogomb.addEventListener('click', () => {
    sign.style.display = 'flex';
    setTimeout(() => {
        signbox.style.transform = 'scale(1)';
    }, 100);
})

//This is to toggle between sign in/sign up forms
tosignin.addEventListener('click', () => {
    signup.style.display = 'none';
    signin.style.display = 'block';
});
tosignup.addEventListener('click', () => {
    signup.style.display = 'block';
    signin.style.display = 'none';
});

function SendMail() {
    // Iegūst ievadītās vērtības
    let fullName = document.getElementById("fullName").value;
    let email = document.getElementById("email_id").value;
    let message = document.getElementById("message").value;

    // Pārbauda, vai visi lauki ir aizpildīti
    if (fullName === "" || email === "" || message === "") {
        alert("All fields must be filled!");
        return; // Iziet no funkcijas, ja ir tukši lauki
    }

    // Ja visi lauki ir aizpildīti, nosūta e-pastu
    let parms = {
        from_name: fullName,
        email_id: email,
        message: message
    };

    // Izsūta e-pastu un parāda paziņojumu par veiksmīgu nosūtīšanu
    emailjs.send("service_0yirtxt", "template_k8t7m7o", parms).then(function (res) {
        alert("Your message was sent successfully!");
    });
}
