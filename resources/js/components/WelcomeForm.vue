<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { useDialogPluginComponent, useQuasar } from 'quasar'
import BaseDialog from '@/components/BaseDialog.vue'
import FormInputText from '@/components/FormInputText.vue'
import type { Visit } from '@/types/models'

const props = defineProps<{
    visit: Visit,
}>()

const { dialogRef, onDialogOK, onDialogCancel } = useDialogPluginComponent()

const $q = useQuasar()
const form = useForm({
    passcode: '',
})

const submit = () => {
    form.patch(route('visits.update', props.visit), {
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
            title="Verify visitor's code"
            :loading="form.processing"
            button-text="Validate code"
            @dismiss="onDialogCancel"
            @form:submit="submit"
        >
            <template #content>
                <FormInputText
                    required
                    label="Provide visitor's code"
                    v-model="form.passcode"
                    :error-message="form.errors.passcode"
                />
            </template>
        </BaseDialog>
    </q-dialog>
</template>
