import Popup from './modules/Popup';
import { getContent } from './services/popupService';

const simplePopup = new Popup(
    document.getElementById('simple-popup'),
    {
        onOpen: (popup) => {
            getContent().then((data) => {
                popup.setContent(data.content);
            });
        },
    },
);

document.getElementById('popup-button')
    .addEventListener('click', () => {
        simplePopup.toggle();
    });