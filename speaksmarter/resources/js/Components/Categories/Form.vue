<script>
    //FORMULARIO QUE SERVIRA TANTO PARA ACTUALIZAR COMO PARA CREAR UNA CATEGORIA
    export default {
        name: 'CategoriesForm'
    }
</script>

<script setup>
    import FormSection from '@/Components/FormSection.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';


    defineProps({
        form: {
            type: Object,
            required: true
        },
        updating: { //Prop para saber si el form es de editar o crear
            type: Boolean,
            required: false,
            default: false
        }
    })

    //Se emitira un evento submit, para ejecutar una peticion
    defineEmits(['submit'])
</script>

<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>
            {{ updating ? 'Edit Category' : 'Create Category' }}
        </template>

        <template #description>
            {{ updating ? 'Update the selected category' : 'Create a new category from scratch' }}
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="name" value="name" />
                <TextInput id="name" v-model="form.name" type="text" autocomplete="name" class="mt-1 block w-full" />
                <!-- <InputError :message="$page.props.error.name"/> --> TODO MOSTRAR ERRORES
            </div>
        </template>

        <template #actions>
            <PrimaryButton>
                {{ updating ? 'Update' : 'Create' }}
            </PrimaryButton>
        </template>

    </FormSection>
</template>
