<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Organograma</div>

                    <div class="card-body">
                        <tree :data="treeData"></tree>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        },
        data () {
            return {
                treeData: [
                    { text: 'Item 1', state: { visible: false } },
                    { text: 'Item 2', data: { customProp: 'AAAAAAAAAAAAAAAAAAAA' } },
                    { text: 'Item 3', state: { selected: true } },
                    { text: 'Item 4' },
                    { text: 'Item 5', state: { expanded: true }, children: [
                            { text: 'Item 5.1', state: { disabled: true } },
                            { text: 'Item 5.2', state: { selectable: false } }
                        ], }
                ]
            }
        },
    }
</script>

<style scoped>
    div {
        background: black !important;
    }
</style>
