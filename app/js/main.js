const init = () => {
    const editor = document.getElementById('editor');
    const ed_start_bth = document.getElementById('editor_start');
    const ed_finish_btn = document.getElementById('editor_finish');
    const ed_save_btn = document.getElementById('editor_save');

    let editor_switch = false;
    let truly = true;

    const names = document.querySelectorAll('[data-edit="name"]');
    const descriptions = document.querySelectorAll('[data-edit="description"]');
    const images = document.querySelectorAll('[data-edit="image"]');

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

    const links_life = (value = '', images = undefined) => {
        if (images === undefined) return;
        images.forEach((item) => {
            let formElement = item.parentNode;
            if (formElement.classList.contains('display-none')) {
                if (value === 'alive'){
                    formElement.classList.remove('display-none');
                }
            }else{
                if((value === 'dead')){
                    formElement.classList.add('display-none');
                }
            }
        });
    }

    const turnON_editor = () => {
        if (names.length === 0 && descriptions.length === 0) return;
        if (names.length !== 0 || descriptions.length !== 0) {
            truly = true;
            setter_true_false(names, truly);
            setter_true_false(descriptions, truly);
        }
        links_life('alive', images);
    }

    const turnOFF_editor = () => {
        truly = false;
        setter_true_false(names, truly);
        setter_true_false(descriptions, truly);
        links_life('dead', images);
    }

    const main = () => {
        editor.addEventListener('click', display_editor, false);
        ed_start_bth.addEventListener('click', turnON_editor, false);
        ed_finish_btn.addEventListener('click', turnOFF_editor, false);
        // console.log(names.length);
    };
    main();

}
init();
