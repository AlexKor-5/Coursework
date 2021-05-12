const init = () => {
    const editor = document.getElementById('editor');
    const ed_start_bth = document.getElementById('editor_start');
    const ed_finish_btn = document.getElementById('editor_finish');
    const ed_save_btn = document.getElementById('editor_save');

    let editor_switch = false;
    let truly = true;
    let changed_data = [];


    const names = document.querySelectorAll('[data-edit="name"]');
    const descriptions = document.querySelectorAll('[data-edit="description"]');
    const images = document.querySelectorAll('[data-edit="image"]');
    const links = document.querySelectorAll('[data-edit="link-block"]');

    const display_editor = (event) => {
        let elem = event.currentTarget;
        if (!editor_switch) {
            editor_switch = true;
            elem.style.right = `${0}px`;
        } else {
            editor_switch = false;
            elem.style.right = `${-230}px`;
        }
    }

    const setter_true_false = (array, truly) => {
        array.forEach((item) => {
            if (item.getAttribute('contenteditable')) {
                item.removeAttribute('contenteditable');
                item.setAttribute('contenteditable', `${truly}`);
            }
        });
    }

    const download_buttons_life = (value = '', images = undefined) => {
        if (images === undefined || value === '') return;
        images.forEach((item) => {
            let formElement = item.parentNode;
            if (formElement.classList.contains('display-none')) {
                if (value === 'alive') {
                    formElement.classList.remove('display-none');
                }
            } else {
                if ((value === 'dead')) {
                    formElement.classList.add('display-none');
                }
            }
        });
    }

    const links_blocker = (value = '', links = undefined) => {
        if (value === '' || links === undefined) return;
        console.log(value);

        links.forEach((item, index) => {
            item.onclick = (event) => {
                if (value === 'dead') {
                    event.preventDefault();

                } else if (value === 'alive') {
                    let temp = !!event.target.href;
                    let event_target = 'event.target';
                    while (temp === false) {
                        event_target += '.parentNode';
                        temp = !!eval(event_target + '.href');
                    }
                    console.log(eval(event_target + '.href'));
                    location.href = eval(event_target + '.href');
                }
            }
        });
    }

    const action_link = (event) => {


    }

    const turnON_editor = () => {
        if (names.length === 0 && descriptions.length === 0) return;
        if (names.length !== 0 || descriptions.length !== 0) {
            truly = true;
            setter_true_false(names, truly);
            setter_true_false(descriptions, truly);
        }
        download_buttons_life('alive', images);
        links_blocker('dead', links);
        // console.log('turnON');
    }

    const turnOFF_editor = () => {
        truly = false;
        setter_true_false(names, truly);
        setter_true_false(descriptions, truly);
        download_buttons_life('dead', images);
        links_blocker('alive', links);
        // console.log('turnOFF');
    }

    const recognition = () => {
        let title, desc = null;

        const define_change = (array) => {
            let previous_content = null;
            let new_content, res, id, dom_elem_value = null;
            array.forEach((item) => {
                item.onfocus = (event) => {
                    let element = event.target;
                    previous_content = element.textContent;
                }
                item.onblur = (event) => {
                    let element = event.target;
                    new_content = element.textContent;
                    if (previous_content !== new_content) {
                        res = new_content;
                        dom_elem_value = element.nextElementSibling.value
                        console.log('true ection');
                        return {
                            content: res,
                            id: dom_elem_value
                        };
                    }
                }
            });

        }
        console.log(define_change(names));
        // console.log(define_change(names));

    }


    const main = () => {
        editor.addEventListener('click', display_editor, false);
        ed_start_bth.addEventListener('click', turnON_editor, false);
        ed_finish_btn.addEventListener('click', turnOFF_editor, false);
        recognition();

        // images.forEach((item) => {
        //     item.onchange = (event) => {
        //         console.log(event.target);
        //     }
        // });
    };
    main();

}
init();
