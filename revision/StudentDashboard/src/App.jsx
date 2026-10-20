import Header from "./components/Header";
import Panel from "./components/Panel";
import Footer from "./components/Footer";

function App() {
  return (
    <div className="app">
      <Header />
      <main className="panels">
        <Panel title="View Students" subtitle="See all student records in the system." />
        <Panel title="Add Student" subtitle="Insert a new student record." />
        <Panel title="Reports" subtitle="Generate simple reports or summaries." />
      </main>
      <Footer />
    </div>
  );
}

export default App;
