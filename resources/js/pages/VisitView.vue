<script lang="ts" setup>
import { useQuasar } from 'quasar'
import BasePage from '@/components/BasePage.vue'
import VisitList from '@/components/VisitList.vue'
import WelcomeForm from '@/components/WelcomeForm.vue'
import type { Paginated } from '@/types/common'
import type { Visit } from '@/types/models'

const props = defineProps<{
    visits: Paginated<Visit>,
}>()

const $q = useQuasar()

const launchWelcomeForm = (visit: Visit) => {
    $q.dialog({
        component: WelcomeForm,
        componentProps: {
            visit,
        }
    })
}
</script>

<template>
    <BasePage
        title="Visits"
        heading="Visits"
        :breadcrumbs="[
            { label: 'Visits' }
        ]"
    >
        <template #content>
            <VisitList
                :visits="props.visits"
                @welcome="launchWelcomeForm($event)"
            />
        </template>
    </BasePage>
</template>
