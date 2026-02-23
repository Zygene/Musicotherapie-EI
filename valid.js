window.addEventListener('load', () => {

    const myForm = document.querySelector('#my-form');
    const successBubble = document.querySelector('#success-bubble');

    myForm.onsubmit = async (e) => {
        e.preventDefault();

        const prenom = document.querySelector('#prenom');
        const nom = document.querySelector('#nom');
        const email = document.querySelector('#email');
        const telephone = document.querySelector('#telephone');
        const prefix = document.querySelector('#prefix');
        const message = document.querySelector('#message');

        let messages = [];
        let error = false;

        if(prenom.value.trim() === "") { 
            prenom.classList.add('is-invalid'); 
            messages.push("• Prénom manquant"); 
            error = true;
        } else { prenom.classList.remove('is-invalid'); }

        if(nom.value.trim() === "") { 
            nom.classList.add('is-invalid'); 
            messages.push("• Nom manquant"); 
            error = true;
        } else { nom.classList.remove('is-invalid'); }

        if(email.value.trim() === "") { 
            email.classList.add('is-invalid'); 
            messages.push("• Email manquant"); 
            error = true;
        } else { email.classList.remove('is-invalid'); }

        if(telephone.value.trim() === "") {
            telephone.classList.add('is-invalid');
            messages.push("• Téléphone manquant");
            error = true;
        } else {
            const phoneRegex = /^[0-9+\s.-]{8,20}$/;
            if(!phoneRegex.test(telephone.value.trim())){
                telephone.classList.add('is-invalid');
                messages.push("• Téléphone invalide");
                error = true;
            } else {
                telephone.classList.remove('is-invalid');
            }
        }

        if(message.value.trim() === "") { 
            message.classList.add('is-invalid'); 
            messages.push("• Message manquant"); 
            error = true;
        } else { message.classList.remove('is-invalid'); }

        if(error) {
            successBubble.innerHTML = messages.join("<br>");
            successBubble.classList.add("error");
            successBubble.classList.remove("success");
            successBubble.style.display = "inline-block";
            return;
        }

        try {
            const formData = new FormData();
            formData.append('prenom', prenom.value);
            formData.append('nom', nom.value);
            formData.append('email', email.value);
            formData.append('telephone', prefix.value + telephone.value);
            formData.append('message', message.value);

            const response = await fetch('traitement.php', {
                method: 'POST',
                body: formData
            });

            if(response.ok) {
                successBubble.innerHTML = "✔ Message envoyé";
                successBubble.classList.remove("error");
                successBubble.classList.add("success");
                successBubble.style.display = "inline-block";

                myForm.reset();

            } else {
                throw new Error("Erreur serveur");
            }

        } catch(err) {
            successBubble.innerHTML = "❌ Erreur lors de l'envoi";
            successBubble.classList.add("error");
            successBubble.classList.remove("success");
            successBubble.style.display = "inline-block";
        }
    };
});