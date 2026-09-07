<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { useDialogPluginComponent, useQuasar } from 'quasar'
import BaseDialog from '@/components/BaseDialog.vue'
import FormInputText from '@/components/FormInputText.vue'

const { dialogRef, onDialogOK, onDialogCancel } = useDialogPluginComponent()

const $q = useQuasar()
const form = useForm({
    unit_number: '',
})

const submit = () => {
    form.post(route('residential-units.store', {
        residence: route().routeParams.residence,
    }), {
        onSuccess,
    })
}

const onSuccess = () => {
    $q.notify({
        message: 'Residential unit created successfully.'
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
            title="Residential unit details"
            :loading="form.processing"
            button-text="Save Residential unit Details"
            @dismiss="onDialogCancel"
            @form:submit="submit"
        >
            <template #content>
                <FormInputText
                    required
                    label="Residential unit label (e.g Hse. No 5)"
                    v-model="form.unit_number"
                    :error-message="form.errors.unit_number"
                    @update:model-value="form.clearErrors('unit_number')"
                />
            </template>
        </BaseDialog>
    </q-dialog>
</template>
