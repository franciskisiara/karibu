<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { useDialogPluginComponent, useQuasar } from 'quasar'
import BaseDialog from '@/components/BaseDialog.vue'
import FormInputText from '@/components/FormInputText.vue'
import type { Occupancy } from '@/types/models'

const props = defineProps<{
    occupancy: Occupancy,
}>()

const { dialogRef, onDialogOK, onDialogCancel } = useDialogPluginComponent()

const $q = useQuasar()
const form = useForm({
    email: '',
    occupancy_id: props.occupancy.id,
})

const submit = () => {
    form.post(route('visits.store'), {
        onSuccess,
    })
}

const onSuccess = () => {
    $q.notify({
        message: 'Visitor invited successfully.'
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
            title="Send an invite"
            :loading="form.processing"
            button-text="Send Invitation"
            @dismiss="onDialogCancel"
            @form:submit="submit"
        >
            <template #content>
                <FormInputText
                    required
                    label="Provide visitor's email"
                    v-model="form.email"
                    :error-message="form.errors.email"
                />
            </template>
        </BaseDialog>
    </q-dialog>
</template>
