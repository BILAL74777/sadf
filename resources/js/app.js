require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import toastr from 'toastr';

// InertiaProgress.init();

window.toastr = toastr;
toastr.options = {
    "positionClass": "toast-bottom-right",
}

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Portafolio Cast';

// making global components
import Translation from "@/Pages/Translation";
import ImageZooming from "@/Pages/Global/ImageZooming";
import DeleteModal from "@/Pages/Global/DeleteModal";
 

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component('Link', Link)
            .component('Translation', Translation)
            .component('ImageZooming', ImageZooming)
            .component('DeleteModal', DeleteModal)
            .mixin({
                methods: { route,
                    translate(value){

                        // return value;


                        let tras = this.$page.props.lang_data[value];
                        
                        if (typeof tras !== 'undefined') {
                            // checking if the translation found than use it.    
                            return tras;
                        }else{
                            
                            if (value) {
                                axios.post(route('api.missing-translations.store'),{ value });
                            }

                        }
                        
                        return value;
                    }
                }
            })
            .mount(el);
    }
});

InertiaProgress.init({ color: '#4B5563' });

