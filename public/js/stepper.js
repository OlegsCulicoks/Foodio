document.addEventListener('DOMContentLoaded', function() {
    const stepForms = document.querySelectorAll('.step-content');
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');

    nextButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const currentStep = this.closest('.step-content');
            const nextStep = currentStep.nextElementSibling;

            if (nextStep) {
                currentStep.classList.remove('active');
                nextStep.classList.add('active');
                updateStepper(parseInt(nextStep.dataset.step));
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const currentStep = this.closest('.step-content');
            const prevStep = currentStep.previousElementSibling;

            if (prevStep) {
                currentStep.classList.remove('active');
                prevStep.classList.add('active');
                updateStepper(parseInt(prevStep.dataset.step));
            }
        });
    });

    function updateStepper(currentStep) {
        const stepItems = document.querySelectorAll('.step-item');
        const stepLines = document.querySelectorAll('.step-line');

        stepItems.forEach((item, index) => {
            if (index < currentStep) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });

        stepLines.forEach((line, index) => {
            if (index < currentStep - 1) {
                line.classList.add('active');
            } else {
                line.classList.remove('active');
            }
        });
    }
});

