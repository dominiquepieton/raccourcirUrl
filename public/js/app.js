//Animation du texte

// Animation écriture
const txtAnim = document.querySelector('.txt-animation');
let typewriter = new Typewriter(txtAnim, {
    loop: false,
    deleteSpeed: 20
});

typewriter.pauseFor(1800)
        .changeDelay(20)
        .typeString('Une url trop longue ? ')
        .pauseFor(300)
        .typeString('Envie de la reduire !')
        .pauseFor(1000)
        .deleteChars(21)
        .typeString('Testez votre url dans le champ ci-dessous')
        .start();