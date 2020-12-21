<template>
    <div>
        <h2>Custom component mounted</h2>
    </div>
</template>

<script>
export default {

    mounted() {
        let channel = Echo.join('user-channel');
        channel.here((users) => {console.log(users)});
        channel.joining((user) => {console.log('joining'+user)});
        channel.leaving((user) => {console.log('leaving'+user)});
        channel.listen('.UserEvent', (data) => {
            console.log(data);
        });
        console.log(channel);
    },
}
</script>
