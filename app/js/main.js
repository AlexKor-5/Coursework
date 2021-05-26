'use strict'
import "./submain.js";

const init = () => {
    const editor = document.getElementById('editor');
    const ed_start_bth = document.getElementById('editor_start');
    const ed_finish_btn = document.getElementById('editor_finish');
    const ed_save_btn = document.getElementById('editor_save');

    let editor_switch = false;
    let truly = true;
    let changed_data_title = [];
    let changed_data_desc = [];
    let changed_data_images = [];

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
        changed_data_title = [];
        changed_data_desc = [];
        // console.log('turnOFF');
    }

    const get_object_data = (obj, array) => {
        array.push(obj);
        let current_object = array[array.length - 1];
        // save identity in array
        if (array.length > 1) {
            for (let i = 0; i < array.length - 1; i++) {

                if (array[i].id === current_object.id) {
                    array.splice(i, 1);
                }
            }
        }
        return array;
    }

    const recognition = async () => {

        const define_change = async (array, array_taker) => {
            let previous_content = null;
            let new_content, res, dom_elem_value, dom_elem_name = null;


            const action_await = (data) => {
                return new Promise((resolve, reject) => {
                    resolve(data);
                }).then((res) => {
                    return res;
                });
            }

            array.forEach((item) => {
                item.onfocus = (event) => {
                    let element = event.target;
                    previous_content = element.textContent;
                }
                item.onblur = async (event) => {
                    let element = event.target;
                    new_content = element.textContent;
                    if (previous_content !== new_content) {
                        res = new_content;
                        dom_elem_value = element.nextElementSibling.value;
                        dom_elem_name = element.nextElementSibling.name;
                        let obj = {
                            content: res,
                            id: dom_elem_value,
                            type_id: dom_elem_name
                        };
                        array_taker = get_object_data(obj, array_taker);
                        console.log(array_taker);
                    }
                }
            });
        }//end of define_change

        const define_image_change = (images, array_taker) => {
            images.forEach((input) => {
                input.onchange = () => {
                    let file = input.files[0];
                    // let reader = new FileReader();
                    // let blob = new Blob([file], {type: file.type});
                    console.log(file);
                    let image_id = input.nextElementSibling.value;
                    let location_id = input.nextElementSibling.nextElementSibling.value;
                    let type_id = input.nextElementSibling.nextElementSibling.name;
                    let object = {
                        data_blob: file,
                        location_id: location_id,
                        type_id: type_id,
                        id: image_id,
                        file_type: file.type,
                        file_size: file.size,
                        file_name: file.name
                    }
                    array_taker = get_object_data(object, array_taker);
                    console.log(array_taker);

                }
            })
        }
        define_image_change(images, changed_data_images);
        define_change(names, changed_data_title);
        define_change(descriptions, changed_data_desc);
    }

    const send_data_to_server = async () => {
        console.log('-----console--send--data---');
        let final_object = {
            names: changed_data_title,
            descriptions: changed_data_desc,
            images: changed_data_images
        };
        let response = await fetch('update_content.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(final_object)
        });
    }


    const main = () => {
        editor.addEventListener('click', display_editor, false);
        ed_start_bth.addEventListener('click', turnON_editor, false);
        ed_finish_btn.addEventListener('click', turnOFF_editor, false);
        recognition();
        ed_save_btn.addEventListener('click', send_data_to_server, false)

    };
    main();

}
init();
