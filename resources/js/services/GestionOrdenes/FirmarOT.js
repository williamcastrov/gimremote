import url from "../../components/Url";
const baseUrl = `${url}/api/firmarot`;
import axios from "axios";
const firmarot = {};

firmarot.save = async (data) => {
    console.log("DATA : ", data)
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

firmarot.listfirmasot = async (id_fir) => {
    const urlList = baseUrl+"/listar_firmasOT/"+id_fir
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

firmarot.update = async (data) => {
    //console.log(data);
    //console.log("DATA : ", data.id);
    const urlUpdate = baseUrl+"/update/"+data.id_fir
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

firmarot.delete = async (id_fir) => {
    const urlDelete = baseUrl+"/delete/"+id_fir
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default firmarot;