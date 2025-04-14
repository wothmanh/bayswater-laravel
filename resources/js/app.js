import './bootstrap';

// Import Flatpickr
import flatpickr from "flatpickr";
// Import Flatpickr styles
import "flatpickr/dist/flatpickr.min.css";

// Make flatpickr available globally if needed, or initialize directly in Blade scripts
window.flatpickr = flatpickr;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
