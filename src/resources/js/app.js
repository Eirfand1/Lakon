import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
Livewire.start();
import './bootstrap';
import flatpickr from "flatpickr";

import "choices.js/public/assets/styles/choices.css";
import Choices from 'choices.js';
window.Choices = Choices;

import numberToText from 'number-to-text'
import 'number-to-text/converters/id'
window.numberToText = numberToText;


import L from 'leaflet';
window.L = L;


function applyDarkMode() {
    const lightSwitches = document.querySelectorAll('.light-switch');
    if (lightSwitches.length > 0) {
        lightSwitches.forEach((lightSwitch, i) => {
            if (localStorage.getItem('dark-mode') === 'true') {
                lightSwitch.checked = true;
                document.documentElement.classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            } else {
                lightSwitch.checked = false;
                document.documentElement.classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            }

            lightSwitch.addEventListener('change', () => {
                const { checked } = lightSwitch;
                lightSwitches.forEach((el, n) => {
                    if (n !== i) {
                        el.checked = checked;
                    }
                });

                document.documentElement.classList.add('[&_*]:!transition-none');
                if (checked) {
                    document.documentElement.classList.add('dark');
                    document.querySelector('html').style.colorScheme = 'dark';
                    localStorage.setItem('dark-mode', true);
                    document.dispatchEvent(new CustomEvent('darkMode', { detail: { mode: 'on' } }));
                } else {
                    document.documentElement.classList.remove('dark');
                    document.querySelector('html').style.colorScheme = 'light';
                    localStorage.setItem('dark-mode', false);
                    document.dispatchEvent(new CustomEvent('darkMode', { detail: { mode: 'off' } }));
                }

                setTimeout(() => {
                    document.documentElement.classList.remove('[&_*]:!transition-none');
                }, 1);
            });
        });
    }
}

function initializeFlatpickr() {
    flatpickr('.datepicker', {
        mode: 'range',
        static: true,
        monthSelectorType: 'static',
        dateFormat: 'M j, Y',
        defaultDate: [new Date().setDate(new Date().getDate() - 6), new Date()],
        prevArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
        nextArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
        onReady: (selectedDates, dateStr, instance) => {
            instance.element.value = dateStr.replace('to', '-');
            const customClass = instance.element.getAttribute('data-class');
            instance.calendarContainer.classList.add(customClass);
        },
        onChange: (selectedDates, dateStr, instance) => {
            instance.element.value = dateStr.replace('to', '-');
        },
    });
}

function sekolahDropDown() {
    $('#kecamatan_dropdown, #desa_dropdown').select2({
        placeholder: "Pilih",
        allowClear: true,
        width: '100%',
        containerCssClass: 'select2-tailwind-container',
        dropdownCssClass: 'select2-tailwind-dropdown',
        selectionCssClass: 'select2-tailwind-selection'
    });

    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/districts/3301.json')
        .then(response => response.json())
        .then(data => {
            let kecamatanSelect = $('#kecamatan_dropdown');
            data.forEach(kecamatan => {
                // Store the name as data attribute on the option
                let option = new Option(kecamatan.name, kecamatan.id);
                $(option).data('name', kecamatan.name);
                kecamatanSelect.append(option);
            });
        })
        .catch(error => console.error('Error fetching kecamatan:', error));

    $('#kecamatan_dropdown').on('change', function() {
        let kecamatanID = $(this).val();
        let desaSelect = $('#desa_dropdown');

        // Get the text of the selected option for kecamatan
        let kecamatanName = $("#kecamatan_dropdown option:selected").text();
        $('#kecamatan').val(kecamatanName);

        desaSelect.empty().append(new Option("Pilih Desa", "")); // Reset desa

        if (kecamatanID) {
            // Ambil daftar desa dari API
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanID}.json`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(desa => {
                        // Store the name as data attribute on the option
                        let option = new Option(desa.name, desa.id);
                        $(option).data('name', desa.name);
                        desaSelect.append(option);
                    });
                })
                .catch(error => console.error('Error fetching desa:', error));
        }
    });

    $('#desa_dropdown').on('change', function() {
        // Get the text of the selected option for desa
        let desaName = $("#desa_dropdown option:selected").text();
        $('#desa').val(desaName);
    });
};

window.editSekolahDropDown = function(selectedKecamatanName = null, selectedDesaName = null) {
    $('#edit_kecamatan_dropdown, #edit_desa_dropdown').select2({
        placeholder: "Pilih",
        allowClear: true,
        width: '100%',
        containerCssClass: 'select2-tailwind-container',
        dropdownCssClass: 'select2-tailwind-dropdown',
        selectionCssClass: 'select2-tailwind-selection'
    });

    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/districts/3301.json')
        .then(response => response.json())
        .then(data => {
            let kecamatanSelect = $('#edit_kecamatan_dropdown');
            kecamatanSelect.empty().append(new Option("Pilih Kecamatan", "")); // Reset kecamatan

            data.forEach(kecamatan => {
                let option = new Option(kecamatan.name, kecamatan.id);
                $(option).data('name', kecamatan.name);

                // Set selected jika nama kecamatan cocok
                if (selectedKecamatanName && kecamatan.name === selectedKecamatanName) {
                    $(option).attr('selected', 'selected');
                }

                kecamatanSelect.append(option);
            });

            // Trigger change untuk memuat desa jika ada kecamatan yang dipilih
            if (selectedKecamatanName) {
                kecamatanSelect.val(function() {
                    return this.options[this.selectedIndex].value;
                }).trigger('change');
            }
        })
        .catch(error => console.error('Error fetching kecamatan:', error));

    $('#edit_kecamatan_dropdown').on('change', function() {
        let kecamatanID = $(this).val();
        let desaSelect = $('#edit_desa_dropdown');

        // Get the text of the selected option for kecamatan
        let kecamatanName = $("#edit_kecamatan_dropdown option:selected").text();
        $('#edit_kecamatan').val(kecamatanName);

        desaSelect.empty().append(new Option("Pilih Desa", "")); // Reset desa

        if (kecamatanID) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanID}.json`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(desa => {
                        let option = new Option(desa.name, desa.id);
                        $(option).data('name', desa.name);

                        // Set selected jika nama desa cocok
                        if (selectedDesaName && desa.name === selectedDesaName) {
                            $(option).attr('selected', 'selected');
                        }

                        desaSelect.append(option);
                    });

                    // Trigger change untuk update nilai desa
                    if (selectedDesaName) {
                        desaSelect.val(function() {
                            return this.options[this.selectedIndex].value;
                        }).trigger('change');
                    }
                })
                .catch(error => console.error('Error fetching desa:', error));
        }
    });

    $('#edit_desa_dropdown').on('change', function() {
        let desaName = $("#edit_desa_dropdown option:selected").text();
        $('#edit_desa').val(desaName);
    });
}

applyDarkMode();
initializeFlatpickr();
sekolahDropDown();
window.editSekolahDropDown();

document.addEventListener('livewire:navigated', () => {
    applyDarkMode();
    initializeFlatpickr();
    sekolahDropDown();
    window.editSekolahDropDown();
});

document.addEventListener('livewire:update', () => {
    window.Alpine && window.Alpine.initTree(document.body);
});
