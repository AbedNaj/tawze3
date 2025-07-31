import './bootstrap';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

const notyf = new Notyf(
    { dismissible: true }
);




document.addEventListener('livewire:init', () => {
    window.Livewire.on('notify', ({ type, message }) => {
        if (type === 'success') {
            notyf.success(message)
        } else if (type === 'error') {
            notyf.error(message)
        } else {
            notyf.open({ type, message })
        }
    })
})