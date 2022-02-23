export class Api {
  getMealData = async () => {
    const res = await fetch("http://restaurant.loc/api/get_meals", {
      method: "GET",
    });
    const json = await res.json();
    return json;
  };

  sendOrderData = async (mealNames, sizes, qtys) => {
    const res = fetch("http://restaurant.loc/api/save_order", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body:
        this.addQtyInfo(mealNames, sizes, qtys)
        
      
    });
    const status = (await res).status;
    if(status == 200){
      window.location.href="http://restaurant.loc/";
    }
  };

  addQtyInfo(mealNames, sizes, qtys) {
    const data = JSON.stringify({
      Names: mealNames,
      Sizes: sizes,
      Qtys: qtys,
    });

    return data;
  }
}
