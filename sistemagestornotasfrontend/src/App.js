import './App.css';
import { Route, Routes } from 'react-router-dom';
import { Login } from "Components/Login"
import { UserContextProvider } from "Context/UserContext";
import { Home } from 'Pages/Home';
import { Error403 } from 'Pages/Error403';
import { Periodo } from 'Components/Periodo';
import { CursosNivel } from 'Components/CursoCard';
import { Footer } from "Components/Footer";
import { Actividad } from "Components/Actividad";
import { AssignTeacher } from 'Components/assignTeacher';
import { Header } from 'Components/Header';
import { ListadocursoDocente } from 'Components/ListadoCursosDocente';

function App() {
	return (
		<UserContextProvider>
			<div className='App'>
				<Header/>
				<Routes>
					<Route path = "/Login" element = {<Login />} />
					<Route path= '/' element = {<Home/>} />
					<Route path='/error403' element = {<Error403/>}  />
					<Route path='/periodo' element = {<Periodo />} />

                    <Route path = '/asignarProfesor'  >
                        <Route path = ":idPeriodo" >
                            <Route path = ":idCursoNivel" element = { <AssignTeacher /> } />
                        </Route>
                    </Route>
                    <Route path = '/listadoCursosDocente'  >
                        <Route path = ":idPeriodo" element = { <ListadocursoDocente /> }>
                        </Route>
                    </Route>
					<Route path='/card' element = {<CursosNivel />} />
					<Route path = '/actividad' element = { <Actividad /> } />

				</Routes>
				<Footer/>
			</div>
		</UserContextProvider>
	);
}

export default App;
