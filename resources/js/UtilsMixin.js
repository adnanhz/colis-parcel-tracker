import moment from 'moment';

const UtilsMixin = {
    methods: {
        utcToLocal(dateStr) {
            moment.locale('ar_LB');
            var localTime = moment.utc(dateStr).toDate();
            localTime = moment(localTime);
            return localTime;
        }
    }
}

export default UtilsMixin;