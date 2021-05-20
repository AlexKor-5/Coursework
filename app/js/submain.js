'use strict'
const init_2 = () => {

    const radios_array = document.querySelectorAll(`[data-radio]`);
    const countries_selector = document.querySelector(`[data-select="countries"]`);
    const regions_selector = document.querySelector(` [data-select="regions"]`);

    const action_radios = (radios_array) => {
        radios_array.forEach((radio) => {
            radio.onclick = () => {
                let res = radio.getAttribute(`checked`);
                if (res === ``) {
                    // ( if ) attribute has already existed
                    radio.removeAttribute(`checked`);
                } else {
                    radio.setAttribute(`checked`, ``);
                }
                if (radio.value === `cities` || radio.value === `towns`) {
                    if (regions_selector.classList.contains(`display-none`)) {
                        regions_selector.classList.remove(`display-none`);
                        regions_selector.setAttribute(`name`, `select_regions`);
                        countries_selector.removeAttribute(`name`);
                        if (!countries_selector.classList.contains(`display-none`)) {
                            countries_selector.classList.add(`display-none`);
                        }
                    }
                }
                if (radio.value === `regions`) {
                    if (!regions_selector.classList.contains(`display-none`)) {
                        regions_selector.classList.add(`display-none`);
                        regions_selector.removeAttribute(`name`);
                        if (countries_selector.classList.contains(`display-none`)) {
                            countries_selector.classList.remove(`display-none`);
                        }
                    }
                }
            }
        });
    }

    const main = () => {
        action_radios(radios_array);
        console.log(regions_selector);
    }
    main();
}
init_2()
