import {Controller} from 'stimulus';
import Inputmask    from 'inputmask';

export default class extends Controller {

    /**
     *
     * @returns {string|object}
     */
    get mask() {
        let mask = this.data.get('mask');

        try {
            mask = JSON.parse(mask);
            mask.autoUnmask = mask.autoUnmask || mask.removeMaskOnSubmit || undefined;

            return mask;
        } catch (e) {
            // as string
            return mask;
        }
    }

    /**
     *
     */
    connect() {
        const element = this.element.querySelector('input');
        let mask = this.mask;

        // mask
        if (mask.length < 1) {
            return;
        }

        if (mask.removeMaskOnSubmit) {
            this.element.closest('form').addEventListener('orchid:screen-submit', () => {
                element.inputmask.remove();
            });
            mask.removeMaskOnSubmit = undefined;
        }

        Inputmask(mask).mask(element);
    }
}
