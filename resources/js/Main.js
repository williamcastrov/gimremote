import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import 'antd/dist/antd.css';

// Componentes Menu Bar
import AppNavbar from "./components/NavBar";

// Componentes de Logueo
import Login from './components/Auth/Login';

//Importar COmponentes
import CumplirOrdenTecnico from './pages/GestionOrdenes/CumplirOrden/CumplirOrdenTecnico';
import NombreCargoOT from './pages/GestionOrdenes/NombreCargoOT';
import DatosHorometro from './pages/GestionOrdenes/DatosHorometro';
import InventarioEquipo from './pages/Mantenimiento/InventarioEquipo';

function Main(props) {
    const { metadata, componente, tipousuario, user, idUsu } = props;
    //console.log("VALOR DE USER : ", user)

    return (
        <>
            {!user ?
                <Login />
                :
                <Router >
                    <AppNavbar />
                    <Switch>
                        <Route path="/login" component={Login} />
                    </Switch>
                    <Route path="/cumplimiento/cumplirordentecnico">
                        <CumplirOrdenTecnico tipousuario={tipousuario} idUsu={idUsu} />
                    </Route>

                    <Route path="/cumplimiento/nombrecargoot" component={NombreCargoOT} />
                    <Route path="/cumplimiento/datoshorometro" component={DatosHorometro} />
                    <Route path="/mantenimiento/inventarioequipo" component={InventarioEquipo} />
                </Router>
            }
        </>
    )
}

export default Main;