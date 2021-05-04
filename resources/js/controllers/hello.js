import {Controller} from 'stimulus';

export default class extends Controller {

    /**
     * Stimulus gives the possibility of a change event when the field loses focus
     */
    filter(event) {
        const search = event.target.value.trim().toLowerCase();

        $('.project-element-item')
            .hide()
            .filter((key, item) => $(item).html().trim().toLowerCase().indexOf(search) !== -1)
            .show();

        /* $('.project-element')
            .show()
            .filter((key, item) => $(item).children('.list-group').children(':visible').length === 0)
            .hide();  */
    }
}
