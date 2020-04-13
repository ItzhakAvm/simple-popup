export default class Popup {
    /**
     * Popup constructor.
     *
     * @param object
     * @param options
     * @returns void
     */
    constructor(object, options = {}) {
        this.object = object;
        this.options = {};

        Object.assign(this.options, this.defaults, options);
    }

    /**
     * Toggles the popup.
     *
     * @returns void
     */
    toggle() {
        const style = window.getComputedStyle(this.object);

        if (style.display === 'none') {
            this.open();
        } else {
            this.close();
        }

        this.call('onToggle');
    }

    /**
     * Opens the popup and calls the opening callback.
     *
     * @returns void
     */
    open() {
        this.object.style.display = 'block';
        this.call('onOpen');
    }

    /**
     * Closes the popup and calls the closing callback.
     *
     * @returns void
     */
    close() {
        this.object.style.display = 'none';
        this.call('onClose');
    }

    /**
     * Sets the popup content.
     *
     * @param content
     * @returns void
     */
    setContent(content) {
        this.object.querySelector(`.${this.options.contentClass}`)
            .innerHTML = content;
    }

    /**
     * Calls the provided callback function.
     *
     * @param callback
     * @returns void
     */
    call(callback) {
        if (typeof this.options[callback] === 'function') {
            this.options[callback].apply(this, [this]);
        }
    }
}

// Attach a default options object to the popup prototype.
Popup.prototype.defaults = {
    contentClass: 'content-container',
};