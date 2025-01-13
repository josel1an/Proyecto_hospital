// Manejo de inputs y efectos de foco
const InputManager = {
    init: function() {
        const inputs = document.querySelectorAll(".input");
        
        inputs.forEach(input => {
            input.addEventListener("focus", this.addFocus);
            input.addEventListener("blur", this.removeFocus);
        });
    },

    addFocus: function() {
        let parent = this.parentNode.parentNode;
        parent.classList.add("focus");
    },

    removeFocus: function() {
        let parent = this.parentNode.parentNode;
        if(this.value == "") {
            parent.classList.remove("focus");
        }
    }
};

export default InputManager;