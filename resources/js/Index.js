import React, { useState, useEffect } from 'react';
import ReactDOM from "react-dom";
import 'bootstrap/dist/css/bootstrap.min.css';
import Main from './Main';
import swal from 'sweetalert';

//Firebase
import firebase from "./server/firebase";
import { getAuth, onAuthStateChanged, signOut } from "firebase/auth";

// Import Web Services
import usuariosServices from "./services/Usuarios";


function Index(props) {
    const [user, setUser] = useState(false);
    const [tipousuario, setTipoUsuario] = useState(0);
    const [metadata, setMetadata] = useState("");
    const [componente, setComponente] = useState("0");
    const [idUsu, setIdUsu] = useState(0);

    // Lee de la base de datos los datos de las paginas para navegar desde el menu inicial
    useEffect(() => {
        async function usuariologueado(dat) {
            //Valida si el Usuario esta logueado en Mercado Repuesto
            const auth = getAuth(firebase);
            onAuthStateChanged(auth, (user) => {
                if (user) {
                    //setMetadata(user.metadata.a);
                    //console.log("CURRENT USER : ", user.metadata.createdAt);
                    setUser(true);

                    async function fetchDataUsuarios() {
                        const res = await usuariosServices.leerUsuario(user.metadata.createdAt);
                        setTipoUsuario(res.data[0].tipo_usu);
                        setComponente(res.data[0].dashboard_usu);
                        setIdUsu(res.data[0].id_usu);
                        //console.log("DATOS COMPONENTE USUARIO : ", res.data[0]);
/*
                        if(res.data[0].id_usu != 1){
                            swal("Acceso Restringido", "Sistema en Mantenimiento", "warning", { button: "Aceptar" });
                            window.location.reload();
                        }   
                        */ 
                    }
                    fetchDataUsuarios();
                    
                } else {
                    console.log("USUARIO NO ESTA LOGUEADO");
                }
            });
        }
        usuariologueado(0);
    }, []);

    return (
       <Main metadata={metadata} componente={componente} tipousuario={tipousuario} user={user} idUsu={idUsu} />
    );
}

export default Index;

if (document.getElementById('gimremote')) {
    ReactDOM.render(<Index />, document.getElementById('gimremote'));
}