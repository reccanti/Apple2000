import { render } from "react-dom";
import { Banner, Wrapper, Splash, ThemeProvider, MenuForm, Menu } from "../lib";

function App() {
  return (
    <ThemeProvider>
      <Wrapper
        menu={
          <Menu>
            <MenuForm />
          </Menu>
        }
      >
        <Splash>
          <h1>
            Apple
            <br />
            ][000e
          </h1>
          <Banner>Now in React!!!</Banner>
        </Splash>
        <Splash>
          <h2>Welcome to Apple ][000e!</h2>
          <p>
            Most iteration on new things happens in the CSS dev site. This is a
            React dev site that we can use to help test React-specific things
          </p>
        </Splash>
      </Wrapper>
    </ThemeProvider>
  );
}

render(<App />, document.getElementById("react-root"));
