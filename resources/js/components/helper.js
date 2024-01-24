export default {
    getNoun(number, one, two, five) {
        let noun
        let n = Math.abs(number)
        
        n %= 100

        if (n >= 5 && n <= 20) {
            noun = five
            return number + ' ' + noun
        }

        n %= 10

        if (n === 1){
            noun = one
            return number + ' ' + noun
        }
        

        if (n >= 2 && n <= 4){
            noun = two
            return number + ' ' + noun
        }

        noun = five
        return number + ' ' + noun
    },

    getPrice(value) {
        return value.toLocaleString('ru')
    },

    getPhone(value) {
        return value ? value.replace(/^\D?(\d{1})\D?(\d{3})\D?\D?(\d{3})\D?(\d{2})\D?(\d{2})/, '+$1 ($2) $3-$4-$5') : null
    },
}