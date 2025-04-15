(function(){
  emailjs.init("Q2wJ_5HLDer20iTBv"); // Remplacez par votre clé publique EmailJS
})();

document.getElementById("paymentForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const email = document.getElementById("email").value;
  const amount = document.getElementById("amount").value;

  const templateParams = {
    user_email: email,
    payment_amount: `$${amount}`,
    site_name: "Pay Now",
    receiver_name: "Joseph",
    payment_link: "https://cash.app/$joseph197800"
  };

  emailjs.send("default_service", "template_7wgdfzi", templateParams)
    .then(function(response) {
      alert("Merci pour votre paiement ! Un reçu vous a été envoyé par email.");
      window.location.href = "https://cash.app/$joseph197800";
    }, function(error) {
      alert("Erreur lors de l'envoi de l'email. Veuillez réessayer.");
      console.log(error);
    });
});
