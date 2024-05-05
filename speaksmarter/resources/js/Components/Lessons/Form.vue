<script>
    //FORMULARIO QUE SERVIRA TANTO PARA ACTUALIZAR COMO PARA CREAR UNA CATEGORIA
    export default {
        name: 'LessonsForm'
    }
</script>

<script setup>
    import FormSection from '@/Components/FormSection.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import CollectionSelector from '@/Components/Common/CollectionSelector.vue';
    import { ref} from 'vue';


    defineProps({
        form: {
            type: Object,
            required: true
        },
        updating: { //Prop para saber si el form es de editar o crear
            type: Boolean,
            required: false,
            default: false
        },
        //Para selects
        levels: {
            type: Object,
            required: true
        },
        categories: {
            type: Object,
            required: true
        }
    })

    //Guardar todas las categorieas
    const categoriesSelected = ref([]);

    //Evento en CollectionSelector para guardar las categorias seleccionadas
    const onCategories = (_categories) => {
        categoriesSelected.value = _categories;
    }

    //Se emitira un evento submit, para ejecutar una peticion
    defineEmits(['submit'])
</script>

<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>
            {{ updating ? 'Edit Lesson' : 'Create Lesson' }}
        </template>

        <template #description>
            {{ updating ? 'Update the selected lesson' : 'Create a new lesson from scratch' }}
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="name" value="name" />
                <TextInput id="name" v-model="form.name" type="text" autocomplete="name" class="mt-1 block w-full" />
                <InputError :message="$page.props.errorBags && $page.props.errorBags.default && $page.props.errorBags.default.name && $page.props.errorBags.default.name[0]"/> <!-- Mejorable ?-->
                <br>

                <InputLabel for="description" value="description" />
                <TextInput id="description" v-model="form.description" type="text" autocomplete="description" class="mt-1 block w-full" />
                <InputError :message="$page.props.errorBags && $page.props.errorBags.default && $page.props.errorBags.default.description && $page.props.errorBags.default.description[0]"/> <!-- Mejorable ?-->
                <br>

                <InputLabel for="content_uri" value="content uri" />
                <TextInput id="content_uri" v-model="form.content_uri" type="text" autocomplete="content_uri" class="mt-1 block w-full" />
                <InputError :message="$page.props.errorBags && $page.props.errorBags.default && $page.props.errorBags.default.content_uri && $page.props.errorBags.default.content_uri[0]"/> <!-- Mejorable ?-->
                <br>

                <InputLabel value="upload PDF" />
                <SecondaryButton class="mt mr-2" type="button" >
                    Upload PDF
                </SecondaryButton>
                <InputError :message="$page.props.errorBags && $page.props.errorBags.default && $page.props.errorBags.default.pdf_uri && $page.props.errorBags.default.pdf_uri[0]"/> <!-- Mejorable ?-->
                <br>


                <div class="w-full mt-5">
                    <div class="flex">
                        <div class="w-1/2 mr-1">
                            <InputLabel for="level" value="level" />
                            <select name="level" id="level" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option v-for="level in levels" :value="level.id" :key="'level-' + level.id">
                                    {{ level.name }}
                                </option>
                            </select>
                            <InputError :message="$page.props.errorBags && $page.props.errorBags.default && $page.props.errorBags.default.level_id && $page.props.errorBags.default.level-id[0]"/> <!-- Mejorable ?-->
                        </div>

                        <div class="w-1/2 ml-1">
                            <InputLabel for="categories" value="categories" />
                            <CollectionSelector :collection="categories" name="categories" id="categories" @onCategories="onCategories"/>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <PrimaryButton>
                {{ updating ? 'Update' : 'Create' }}
            </PrimaryButton>
        </template>

    </FormSection>
</template>
