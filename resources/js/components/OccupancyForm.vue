<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { useDialogPluginComponent, useQuasar } from 'quasar'
import BaseDialog from '@/components/BaseDialog.vue'
import FormInputText from '@/components/FormInputText.vue'
import type { ResidentialUnit } from '@/types/models'

const props = defineProps<{
    residentialUnit: ResidentialUnit,
}>()

const { dialogRef, onDialogOK, onDialogCancel } = useDialogPluginComponent()

const $q = useQuasar()
const form = useForm({
    email: '',
    residential_unit_id: props.residentialUnit.id,
})

const submit = () => {
    form.post(route('occupancies.store'), {
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
            title="Tenancy details"
            :loading="form.processing"
            button-text="Save Tenancy Details"
            @dismiss="onDialogCancel"
            @form:submit="submit"
        >
            <template #content>
                <FormInputText
                    required
                    label="Provide user's email"
                    v-model="form.email"
                    :error-message="form.errors.email"
                />
            </template>
        </BaseDialog>
    </q-dialog>
</template>
