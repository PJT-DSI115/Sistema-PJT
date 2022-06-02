import './App.css';
import { Route, Routes } from 'react-router-dom';
import { Login } from "Components/Login"
import { UserContextProvider } from "Context/UserContext";
import { Home } from 'Pages/Home';
import { Error403 } from 'Pages/Error403';
import { Periodo } from 'Components/Periodo';
import { CursosNivel } from 'Components/CursoCard';
import { Footer } from "Components/Footer";
import { Curso } from 'Components/Curso';
import { AssignTeacher } from 'Components/assignTeacher';
import { Header } from 'Components/Header';

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
					<Route path='/card' element = {<CursosNivel />} />
					<Route path = '/curso' element = { <Curso /> } />

				</Routes>
				<Footer/>
			</div>
		</UserContextProvider>
	);
}

export default App;
