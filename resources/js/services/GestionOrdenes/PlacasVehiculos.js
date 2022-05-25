import url from "../../components/Url";
const baseUrl = `${url}/api/placasvehiculos`;
import axios from "axios";
const placasvehiculos = {};

placasvehiculos.listar_placasvehiculos = async () => {
    const urlList = baseUrl+"/listar_placasvehiculos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

 
export default placasvehiculos;