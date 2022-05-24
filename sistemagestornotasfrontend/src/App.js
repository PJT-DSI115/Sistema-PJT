import './App.css';
import { Route, Routes } from 'react-router-dom';
import { Login } from "Pages/Login"
import { UserContextProvider } from "Context/UserContext";
import { Home } from 'Pages/Home';

function App() {
	return (
		<UserContextProvider>
			<div className='App'>
				<Routes>
					<Route path = "/Login" element = {<Login />} />
					<Route path= '/' element = {<Home/>} />
				</Routes>
			</div>
		</UserContextProvider>
	);
}

export default App;
