export default function() {
    const autofocus = document.querySelector('[autofocus]:not(.autofocused)');
    autofocus.focus();
    autofocus.className += ' autofocused';
}