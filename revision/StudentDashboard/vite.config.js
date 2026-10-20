import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

// Run on localhost:3000 as required by the exercise
export default defineConfig({
  plugins: [react()],
  server: { port: 3000, open: true },
});
