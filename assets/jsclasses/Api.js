export class Api {
  getMealData = async () => {
    const res = await fetch("http://restaurant.loc/api/get_meals", {
      method: "GET",
    });
    const json = await res.json();
    return json;
  };

  sendOrderData = async (mealNames, sizes, qtys) => {
    const data = await fetch("http://restaurant.loc/api/get_meals", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body:
        this.addQtyInfo(mealNames, sizes, qtys)
      
    });

    const res = await data.json();
  };

  addQtyInfo(mealNames, sizes, qtys) {
    JSON.stringify({
      Names: mealNames,
      Sizes: sizes,
      Qtys: qtys,
    });
  }
}
