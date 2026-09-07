<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { useDialogPluginComponent, useQuasar } from 'quasar'
import BaseDialog from '@/components/BaseDialog.vue'
import FormInputText from '@/components/FormInputText.vue'

const { dialogRef, onDialogOK, onDialogCancel } = useDialogPluginComponent()

const $q = useQuasar()
const form = useForm({
    name: '',
})

const submit = () => {
    form.post(route('residences.store'), {
        onSuccess,
    })
}

const onSuccess = () => {
    $q.notify({
        message: 'Residence created successfully.'
    })
    onDialogOK()
}
</script>

<template>
    <q-dialog
        persistent
        ref="dialogRef"
    >
        <BaseDialog
            dismissible
            title="Residence details"
            :loading="form.processing"
            button-text="Save Residence Details"
            @dismiss="onDialogCancel"
            @form:submit="submit"
        >
            <template #content>
                <FormInputText
                    label="Residence name"
                    v-model="form.name"
                    :error-message="form.errors.name"
                />
            </template>
        </BaseDialog>
    </q-dialog>
</template>
