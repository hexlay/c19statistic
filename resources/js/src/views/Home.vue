<template>
    <div>
        <base-header class="pb-6">
            <b-row align-v="center" class="py-4">
                <b-col cols="5" lg="6">
                    <b-form-select v-model="$root.$i18n.locale" :options="langs" size="sm" style="width: auto" @change="onLocaleChange"></b-form-select>
                </b-col>
                <b-col class="text-right" cols="5" lg="6">
                    <span class="text-white mr-1">{{ $t('welcome', {name: user.name}) }}</span>
                    <b-button size="sm" variant="danger" @click="logout">{{ $t('logout') }}</b-button>
                </b-col>
            </b-row>
            <!-- Card stats -->
            <b-row align-v="center">
                <b-col md="6" xl="3">
                    <stats-card :sub-title="summary.deaths"
                                :title="$t('deaths')"
                                icon="ni ni-active-40"
                                type="gradient-red"/>
                </b-col>
                <b-col md="6" xl="3">
                    <stats-card :sub-title="summary.confirmed"
                                :title="$t('confirmed')"
                                icon="ni ni-chart-pie-35"
                                type="gradient-orange"/>
                </b-col>
                <b-col md="6" xl="3">
                    <stats-card :sub-title="summary.recovered"
                                :title="$t('recovered')"
                                icon="ni ni-money-coins"
                                type="gradient-green"/>

                </b-col>
            </b-row>
        </base-header>
        <b-card body-class="p-0" header-class="border-0">
            <template v-slot:header>
                <b-row align-v="center">
                    <b-col>
                        <h3 class="mb-0">{{ $t('title') }}</h3>
                    </b-col>
                    <b-col>
                        <b-form-input v-model="filter" :placeholder="$t('search')" size="sm"></b-form-input>
                    </b-col>
                </b-row>
            </template>
            <b-table :fields='fields' :filter="filter" :items='countryData'></b-table>
        </b-card>
    </div>
</template>
<script>
import StatsCard from '@/components/Cards/StatsCard'

export default {
    name: 'starter-page',
    components: {
        StatsCard,
    },
    data() {
        return {
            user: this.$store.state.auth.user,
            filter: '',
            langs: [
                {
                    value: 'en',
                    text: 'English'
                },
                {
                    value: 'ka',
                    text: 'Georgian'
                },
            ],
        };
    },
    computed: {
        countryData() {
            return this.$store.state.statistic.countryData
        },
        summary() {
            return this.$store.state.statistic.summary
        },
        fields() {
            return [
                {
                    key: 'name',
                    label: this.$t('country'),
                    sortable: true
                },
                {
                    key: 'deaths',
                    label: this.$t('deaths'),
                    sortable: true
                },
                {
                    key: 'confirmed',
                    label: this.$t('confirmed'),
                    sortable: true
                },
                {
                    key: 'recovered',
                    label: this.$t('recovered'),
                    sortable: true,
                }
            ]
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('auth/logout', this)
        },
        onLocaleChange(lang) {
            localStorage.setItem('lang', lang)
        }
    },
    created() {
        this.$store.dispatch(`statistic/fetchCountryData`)
        this.$store.dispatch(`statistic/fetchSummary`)
    },
};
</script>
