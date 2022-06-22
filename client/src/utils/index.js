export const formatPrice = function (value) {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' ₫';
};

export const uniqueArray = function (arr) {
  return arr.filter((value, index, arr) => {
    return arr.indexOf(value) == index;
  });
};

export const ucfirst = function (str) {
  return str ? str[0].toUpperCase() + str.slice(1) : '';
};
