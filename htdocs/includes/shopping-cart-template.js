class ShoppingCart extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        let template = document.querySelector("#shopping-cart");
        let templNode = template.content;
        let shadowRoot = this.attachShadow({mode: "open"});
        shadowRoot.appendChild(templNode);
        shadowRoot.querySelector("a").innerHTML = "Shoppingcart";
    }
}

window.customElements.define("shopping-cart", ShoppingCart);