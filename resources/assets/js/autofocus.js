export default function() {
    const autofocus = document.querySelector('[autofocus]:not(.autofocused)');

    if (!autofocus) {
        return;
    }

    autofocus.focus();
    autofocus.className += ' autofocused';
}